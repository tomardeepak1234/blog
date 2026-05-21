


@extends('admin.admin_meta')

@section('content')

<div style="padding: 2rem 0; font-family: 'DM Sans', sans-serif;">
  <div style="background: white; border: 0.5px solid #e5e5e5; border-radius: 12px; overflow: hidden; max-width: 640px; margin: 0 auto;">

    <div style="height: 4px; background: linear-gradient(90deg, #534AB7, #1D9E75);"></div>

    <div style="padding: 2rem;">
      <span style="background: #EEEDFE; color: #3C3489; font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: .06em;">Blog</span>

      <h1 style="font-family: 'Playfair Display', serif; font-size: 1.7rem; font-weight: 600; margin: 1rem 0; line-height: 1.3;">
        {{ $post->title }}
      </h1>

      <p style="font-size: 15px; color: #666; line-height: 1.7; margin: 0 0 1.5rem;">
        {{ $post->description }}
      </p>

      <div style="display: flex; align-items: center; gap: 10px; padding-top: 1rem; border-top: 0.5px solid #e5e5e5;">
        <div style="width:34px;height:34px;border-radius:50%;background:#EEEDFE;display:flex;align-items:center;justify-content:center;font-size:13px;color:#534AB7;font-weight:500;">
          {{ strtoupper(substr($post->user->name, 0, 2)) }}
        </div>
        <span style="font-size: 13px; color: #888;">Post by <strong style="color: #222;">{{ $post->user->name }}</strong></span>
      </div>
    </div>

    <div style="padding: 1rem 2rem; border-top: 0.5px solid #e5e5e5; background: #fafafa; display: flex; justify-content: space-between; align-items: center;">
      <span style="font-size: 12px; color: #aaa;">{{ $post->created_at->format('M Y') }}</span>
      <a href="{{ url('/post/'.$post->id) }}" style="backgroun

@endsection


