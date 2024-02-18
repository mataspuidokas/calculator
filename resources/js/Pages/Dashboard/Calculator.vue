<template>
    <Head title="Register" />
    <DashboardLayout>
        <div class="flex flex-col align-center w-full">
            <div class="mx-auto max-w-[500px] w-full">
                <h1 class="text-center py-4 text-lg md:text-4xl font-medium">Calculator</h1>
                <div class="w-full mx-auto rounded-xl bg-gray-100 shadow-xl text-gray-800 relative overflow-hidden">
                    <div
                        class="w-full min-h-40 bg-gradient-to-b from-gray-800 to-gray-700 flex flex-col items-end text-right">
                        <div class="w-full py-5 px-6 text-6xl text-white font-thin">{{ previousNumber || 0 }}</div>
                        <div v-if="errors.expression" class="text-lg md:text-base font-medium text-red-600 px-6">
                            {{ errors.expression }}
                        </div>
                        <div v-if="$page.props.flash.result !== null"
                            class="text-lg md:text-base font-medium text-green-600 px-6">
                            {{ $page.props.flash.result }}
                        </div>
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
            <div class="mx-auto w-full" v-if="history.data.length">
                <div class="text-center py-4">
                    <h2 class="text-base md:text-2xl font-medium">Calculator history </h2>
                    <p>({{ history.meta.per_page }} per page)</p>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 ">
                    <div v-for="history in history.data" :key="history.id" class="mb-4 p-4 bg-white shadow-md rounded-lg">
                        <p class="text-lg font-semibold mb-2 md:col-span-2">{{ history.expression }} =</p>
                        <p class="text-gray-700">{{ history.result }}</p>
                    </div>
                </div>

                <template v-if="history.meta.total > history.meta.per_page">
                    <Pagination :pagination="history.meta" />
                </template>
            </div>

        </div>
    </DashboardLayout>
</template>
<script>
import DashboardLayout from '../Layouts/Dashboard.vue';
import Pagination from '../../Components/Pagination.vue';
import { Head, router } from '@inertiajs/vue3';
import CalculatorConstants from '../../Constants/Calculator';

export default {
    data() {
        return {
            expression: null,
            previousNumber: '',
            current: '',
            buttons: [
                [{ value: CalculatorConstants.CLEAR, type: '' }, { value: CalculatorConstants.TOGGLE_SIGN, type: '' }, { value: CalculatorConstants.PERCENT_SIGN, type: '' }, { value: '/', type: CalculatorConstants.OPERATOR }],
                [{ value: 7, type: '' }, { value: 8, type: '' }, { value: 9, type: '' }, { value: '*', type: CalculatorConstants.OPERATOR }],
                [{ value: 4, type: '' }, { value: 5, type: '' }, { value: 6, type: '' }, { value: '-', type: CalculatorConstants.OPERATOR }],
                [{ value: 1, type: '' }, { value: 2, type: '' }, { value: 3, type: '' }, { value: '+', type: CalculatorConstants.OPERATOR }],
                [{ value: 0, type: '' }, { value: CalculatorConstants.DOT_SIGN, type: '' }, { value: CalculatorConstants.EQUAL_SIGN, type: CalculatorConstants.OPERATOR }]
            ],
            operators: []
        }
    },

    props: {
        errors: Object,
        history: {
            type: Object,
            required: true,
        },
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
                    this.errors.expression = null;
                    router.post(route('calculator.store'), {
                        expression: this.current + this.previousNumber,
                    });
                    break;
                default:
                    this.errors.expression = null;
                    if (this.operators.includes(button.value)) {
                        this.appendOperator(button.value);
                    } else {
                        this.appendDigit(button.value);
                    }
            }
        },

        clearDisplay() {
            this.current = '';
            this.previousNumber = '';
        },

        toggleSign() {
            if (this.previousNumber) {
                this.previousNumber = this.previousNumber.charAt(0) === '-' ?
                    this.previousNumber.slice(1) : `(-${this.previousNumber})`;
            }
        },

        applyPercentage() {
            this.previousNumber = `${Number(this.previousNumber) / 100}`;
        },

        appendDecimal() {
            if (!this.previousNumber.includes(CalculatorConstants.DOT_SIGN)) {
                this.previousNumber += CalculatorConstants.DOT_SIGN;
            }
        },

        appendOperator(value) {
            this.operatorPressed = true;
            this.current = `${this.current}${this.previousNumber}${value}`;
        },

        appendDigit(value) {
            if (this.operatorPressed) {
                this.previousNumber = '';
                this.operatorPressed = false;
            }
            this.previousNumber = `${this.previousNumber}${value}`;

        }
    },

    components: {
        DashboardLayout,
        Head,
        Pagination
    },
}
</script>