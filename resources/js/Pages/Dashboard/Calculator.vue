<template>
    <Head title="Register" />
    <DashboardLayout>
        <div class="max-w-[500px] w-full">
            <h1 class="text-center py-4 text-lg md:text-4xl font-medium">Calculator</h1>
            <div class="w-full mx-auto rounded-xl bg-gray-100 shadow-xl text-gray-800 relative overflow-hidden">
                <div class="w-full h-40 bg-gradient-to-b from-gray-800 to-gray-700 flex items-end text-right">
                    <div class="w-full py-5 px-6 text-6xl text-white font-thin">{{ current || 0 }}</div>
                </div>
                <div class="container w-full bg-gradient-to-b from-blue-400 to-blue-700">
                    <div v-for="(row, rowIndex) in buttons" :key="rowIndex" class="flex w-full">
                        <div v-for="(button, colIndex) in row" :key="colIndex"
                            v-bind:class="{ 'w-2/4': rowIndex === buttons.length - 1 && colIndex === 0, 'w-1/4': rowIndex !== buttons.length - 1 || colIndex !== 0 }"
                            class="button-item border-r border-b border-blue-400 transition duration-300 ease-in-out transform hover:bg-blue-600 hover:border-blue-600">
                            <button @click="handleButtonClick(button)"
                                class="w-full h-16 outline-none focus:outline-none text-white">
                                {{ button.value }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
<script>
import DashboardLayout from '../Layouts/Dashboard.vue';
import { Head } from '@inertiajs/vue3';
import CalculatorConstants from '../../Constants/Calculator';

export default {
    data: () => {
        return {
            current: '',
            buttons: [
                [{ value: CalculatorConstants.CLEAR, type: '' }, { value: CalculatorConstants.TOGGLE_SIGN, type: '' }, { value: CalculatorConstants.PERCENT_SIGN, type: '' }, { value: '/', type: CalculatorConstants.OPERATOR }],
                [{ value: 7, type: '' }, { value: 8, type: '' }, { value: 9, type: '' }, { value: 'x', type: CalculatorConstants.OPERATOR }],
                [{ value: 4, type: '' }, { value: 5, type: '' }, { value: 6, type: '' }, { value: '-', type: CalculatorConstants.OPERATOR }],
                [{ value: 1, type: '' }, { value: 2, type: '' }, { value: 3, type: '' }, { value: '+', type: CalculatorConstants.OPERATOR }],
                [{ value: 0, type: '' }, { value: CalculatorConstants.DOT_SIGN, type: '' }, { value: CalculatorConstants.EQUAL_SIGN, type: CalculatorConstants.OPERATOR }]
            ],
            operators: []
        }
    },

    created() {
        this.operators = this.buttons
            .flat()
            .filter(btn => btn.type === CalculatorConstants.OPERATOR)
            .map(btn => btn.value);
    },

    methods: {
        handleButtonClick(button) {
            switch (button.value) {
                case CalculatorConstants.CLEAR:
                    this.clearDisplay();
                    break;
                case CalculatorConstants.TOGGLE_SIGN:
                    this.toggleSign();
                    break;
                case CalculatorConstants.PERCENT_SIGN:
                    this.applyPercentage();
                    break;
                case CalculatorConstants.DOT_SIGN:
                    this.appendDecimal();
                    break;
                case CalculatorConstants.EQUAL_SIGN:
                    // TODO: handle logic
                    break;
                default:
                    if (this.operators.includes(button.value)) {
                        this.appendOperator(button.value);
                    } else {
                        this.appendDigit(button.value);
                    }
            }
        },

        clearDisplay() {
            this.current = '';
        },

        toggleSign() {
            if (this.current) {
                this.current = this.current.charAt(0) === '-' ?
                    this.current.slice(1) : `-${this.current}`;
            }
        },

        applyPercentage() {
            this.current = `${parseFloat(this.current) / 100}`;
        },

        appendDecimal() {
            if (this.current.indexOf(CalculatorConstants.DOT_SIGN) === -1) {
                this.current += CalculatorConstants.DOT_SIGN;
            }
        },

        appendOperator(value) {
            if (this.current) {
                const lastChar = this.current.slice(-1);
                if (this.operators.includes(lastChar)) {
                    this.current = this.current.slice(0, -1) + value;
                } else {
                    this.current += value;
                }
            }
        },

        appendDigit(value) {
            this.current = `${this.current}${value}`;
        }
    },

    components: {
        DashboardLayout,
        Head,
    },
}
</script>