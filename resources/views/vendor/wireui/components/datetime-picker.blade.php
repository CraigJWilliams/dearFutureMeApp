<div
    x-data="wireui_datetime_picker({
        model: @entangleable($attributes->wire('model')),
    })"
    x-props="{
        config: {
            interval: @toJs($interval),
            is12H:    @boolean($timeFormat == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
            min: @toJs($min ? $min->format('Y-m-d\TH:i') : null),
            max: @toJs($max ? $max->format('Y-m-d\TH:i') : null),
            minTime: @toJs($minTime),
            maxTime: @toJs($maxTime),
        },
        withoutTimezone: @boolean($withoutTimezone),
        timezone:      @toJs($timezone),
        userTimezone:  @toJs($userTimezone ?? ''),
        parseFormat:   @toJs($parseFormat ?? ''),
        displayFormat: @toJs($displayFormat ?? ''),
        weekDays:      @lang('wireui::messages.datePicker.days'),
        monthNames:    @lang('wireui::messages.datePicker.months'),
        withoutTime:   @boolean($withoutTime),
    }"
    {{ $attributes
        ->only('wire:key')
        ->class('relative w-full')
        ->merge(['wire:key' => "datepicker::{$name}"]) }}
>
    <x-dynamic-component
        :component="WireUi::component('input')"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key', 'readonly']) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        readonly
        x-on:click="toggle"
        x-bind:value="model ? getDisplayValue() : null">
        @if (!$readonly && !$disabled)
            <x-slot name="append">
                <div class="absolute inset-y-0 flex items-center justify-center right-3 z-5">
                    <div class="flex items-center gap-x-2 my-auto
                        {{ $errors->has($name) ? 'text-negative-400 dark:text-negative-600' : 'text-secondary-400' }}">

                        @if ($clearable)
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                class="w-4 h-4 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500"
                                x-cloak
                                name="x"
                                x-show="model"
                                x-on:click="clearDate()"
                            />
                        @endif

                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="w-5 h-5 cursor-pointer"
                            :name="$rightIcon"
                            x-on:click="toggle"
                        />
                    </div>
                </div>
            </x-slot>
        @endif
    </x-dynamic-component>

    <x-wireui::parts.popover
        :margin="(bool) $label"
        root-class="sm:!w-72 ml-auto"
        class="p-3 overflow-y-auto max-h-96 sm:w-72"
    >
        <div x-show="tab === 'date'" class="space-y-5">
            @unless ($withoutTips)
                <div class="grid grid-cols-3 text-center gap-x-2 text-secondary-600">
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="border-none bg-secondary-100 dark:bg-secondary-800"
                        x-on:click="selectYesterday"
                        :label="__('wireui::messages.datePicker.yesterday')"
                    />

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="border-none bg-secondary-100 dark:bg-secondary-800"
                        x-on:click="selectToday"
                        :label="__('wireui::messages.datePicker.today')"
                    />

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="border-none bg-secondary-100 dark:bg-secondary-800"
                        x-on:click="selectTomorrow"
                        :label="__('wireui::messages.datePicker.tomorrow')"
                    />
                </div>
            @endunless

            <div class="flex items-center justify-between">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!monthsPicker"
                    x-on:click="previousMonth"
                    icon="chevron-left"
                    flat
                />

                <div class="flex items-center justify-center w-full gap-x-2 text-secondary-600 dark:text-secondary-500">
                    <button class="focus:outline-none focus:underline"
                            x-text="monthNames[month]"
                            x-on:click="monthsPicker = !monthsPicker"
                            type="button">
                    </button>
                    <input class="p-0 border-none appearance-none w-14 ring-0 focus:ring-0 focus:outline-none dark:bg-secondary-800"
                           x-model="year"
                           x-on:input.debounce.500ms="fillPickerDates"
                           type="number"
                    />
                </div>

                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!monthsPicker"
                    x-on:click="nextMonth"
                    icon="chevron-right"
                    flat
                />
            </div>

            <div class="relative">
                <div class="absolute inset-0 grid grid-cols-3 gap-3 bg-white dark:bg-secondary-800"
                     x-show="monthsPicker"
                     x-transition>
                    <template x-for="(monthName, index) in monthNames" :key="`month.${monthName}`">
                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            class="uppercase text-secondary-400 dark:border-0 dark:hover:bg-secondary-700"
                            x-on:click="selectMonth(index)"
                            x-text="monthName"
                            xs
                        />
                    </template>
                </div>

                <div class="grid grid-cols-7 gap-2">
                    <template x-for="day in weekDays" :key="`week-day.${day}`">
                        <span class="text-center uppercase pointer-events-none text-secondary-400 text-3xs"
                            x-text="day">
                        </span>
                    </template>

                    <template
                        x-for="date in dates"
                        :key="`date.${date.day}.${date.month}`"
                    >
                        <div class="flex justify-center picker-days">
                            <button class="h-6 text-sm rounded-md w-7 focus:outline-none focus:ring-2 focus:ring-ofsset-2 focus:ring-primary-600 hover:bg-primary-100 dark:hover:bg-secondary-700 dark:focus:ring-secondary-400 disabled:cursor-not-allowed"
                                :class="{
                                    'text-secondary-600 dark:text-secondary-400': !date.isDisabled && !date.isSelected && date.month === month,
                                    'text-secondary-400 dark:text-secondary-600': date.isDisabled || date.month !== month,
                                    'text-primary-600 border border-primary-600 dark:border-gray-400': date.isToday && !date.isSelected,
                                    'disabled:text-primary-400 disabled:border-primary-400': date.isToday && !date.isSelected,
                                    '!text-white bg-primary-600 font-semibold border border-primary-600': date.isSelected,
                                    'disabled:bg-primary-400 disabled:border-primary-400': date.isSelected,
                                    'hover:bg-primary-600 dark:bg-secondary-700 dark:border-secondary-400': date.isSelected,
                                }"
                                :disabled="date.isDisabled"
                                x-on:click="selectDate(date)"
                                x-text="date.day"
                                type="button">
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="tab === 'time'" x-transition>
            <x-dynamic-component
                :component="WireUi::component('input')"
                id="search.{{ $attributes->wire('model')->value() }}"
                :label="__('wireui::messages.selectTime')"
                x-model="searchTime"
                x-bind:placeholder="getSearchPlaceholder"
                x-ref="searchTime"
                x-on:input.debounce.150ms="onSearchTime($event.target.value)"
            />

            <div x-ref="timesContainer"
                 class="flex flex-col w-full pt-2 pb-1 mt-1 overflow-y-auto max-h-52 picker-times">
                <template x-for="time in filteredTimes" :key="time.value">
                    <button class="relative py-2 pl-2 text-left transition-colors duration-100 ease-in-out rounded-md cursor-pointer select-none group focus:outline-none focus:bg-primary-100 dark:focus:bg-secondary-700 pr-9 hover:text-white hover:bg-primary-600 dark:hover:bg-secondary-700 dark:text-secondary-400"
                            :class="{
                            'text-primary-600': modelTime === time.value,
                            'text-secondary-700': modelTime !== time.value,
                        }"
                        :name="`times.${time.value}`"
                        type="button"
                        x-on:click="selectTime(time)">
                        <span x-text="time.label"></span>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600 dark:text-secondary-400 group-hover:text-white"
                              x-show="modelTime === time.value">
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                name="check"
                                class="w-5 h-5"
                            />
                        </span>
                    </button>
                </template>
            </div>
        </div>
    </x-wireui::parts.popover>
</div>