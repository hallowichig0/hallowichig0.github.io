<div {{ $attributes->merge(['class' => $type, 'role' => 'alert']) }}>
  {!! $message ?? $slot !!}
</div>
