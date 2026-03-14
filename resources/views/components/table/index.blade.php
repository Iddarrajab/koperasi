<!-- <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 dark:divide-gray-700']) }}>
    {{ $slot }}
</table> -->
<div class="bg-white dark:bg-[#111822] rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm overflow-hidden">
    <div class="overflow-x-auto max-w-full">
        <table class="w-full table-auto text-left">
            {{ $slot }}
        </table>
    </div>
</div>