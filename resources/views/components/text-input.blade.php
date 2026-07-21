@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-gray-300 bg-white text-slate-900 placeholder:text-slate-400 focus:border-orange-500 focus:ring-orange-500 focus:ring-2 rounded-md shadow-sm']) }}>
