<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function export(Request $request)
    {

        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
        ]);

        $query = User::with(['role', 'state'])
         ->whereIn('role_id', [2, 3])
            ->whereBetween('created_at', [
                $request->from_date . ' 00:00:00',
                $request->to_date   . ' 23:59:59',
            ])
            ->orderBy('created_at', 'asc');

        $fileName = 'users_' . $request->from_date . '_to_' . $request->to_date . '.csv';

        $counter = 1;

        $callback = function () use ($query, &$counter) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'S.No', 'Full Name', 'Email', 'Phone',
                'Username', 'Role', 'State',
            ]);

            $query->chunk(1000, function ($users) use ($handle, &$counter) {

                foreach ($users as $user) {

                    $fullName = strtoupper(
                        trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))
                    ) ?: 'N/A';

                    fputcsv($handle, [
                        $counter++,
                        $fullName,
                        $user->email        ?? '',
                        $user->phone        ?? '',
                        $user->username     ?? '',
                        $user->role?->name  ?? 'N/A',
                        $user->state?->name ?? 'N/A',
                        $user->created_at
                            ? date('d-M-Y H:i:s', strtotime($user->created_at))
                            : '',
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

}
