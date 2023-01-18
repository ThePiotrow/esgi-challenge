<template>
    <div>
        <v-row no-gutters justify="center">
            <v-btn @click="step = 1">RESET</v-btn>
            <v-col cols="12" md="6" lg="5">
                <v-card class="pa-3 mt-12">
                    <!-- STEP 1 -->
                    <div v-if="step === 1">
                        <p class="mb-2 text-h5 font-weight-bold">What kind of bettor are you?</p>
                        <p class="mb-2 text-caption">
                            Your limits are there to help you control your gambling habits. Make sure you play amounts that are consistent with your
                            means.
                        </p>
                        <v-row no-gutters justify="center" class="mb-4">
                            <v-col v-for="(bettorLevel, i) in bettorLevels" :key="i" cols="3"
                                ><div class="text-center">
                                    <v-icon
                                        @click="
                                            selectedBettorLevel = bettorLevel.id;
                                            selectedWeaklyMaxDeposit = bettorLevel.weaklyMaxDeposit;
                                            selectedWeaklyMaxBet = bettorLevel.weaklyMaxBet;
                                        "
                                        size="80"
                                        >{{ bettorLevel.icon }}</v-icon
                                    >
                                </div>
                                <div class="text-center">{{ bettorLevel.id }}</div>
                            </v-col>
                        </v-row>
                        <v-text-field
                            v-model="selectedWeaklyMaxDeposit"
                            label="Maximum weekly deposit"
                            type="number"
                            :rules="weaklyMaxDepositRules"
                            required
                            @click:append-inner="weaklyMaxDepositInfo = true"
                            append-inner-icon="mdi-help-circle"
                        ></v-text-field>
                        <v-dialog width="400" v-model="weaklyMaxDepositInfo">
                            <v-card rounded="xl" class="pa-3">
                                <p class="font-weight-bold text-center">Information</p>
                                <p class="my-2 px-3 text-body-2">
                                    Maximum cumulative amount of your deposits over a period of 7 consecutive days. Any increase in this limit will
                                    only be effective after a minimum of 48 hours.
                                </p>
                                <v-btn class="my-2 px-3" block color="primary" @click="weaklyMaxDepositInfo = false">OK</v-btn>
                            </v-card>
                        </v-dialog>
                        <v-text-field
                            v-model="selectedWeaklyMaxBet"
                            label="Maximum weekly bet"
                            type="number"
                            :rules="weaklyMaxBetRules"
                            required
                            @click:append-inner="weaklyMaxBetInfo = true"
                            append-inner-icon="mdi-help-circle"
                        ></v-text-field>
                        <v-dialog width="400" v-model="weaklyMaxBetInfo">
                            <v-card rounded="xl" class="pa-3">
                                <p class="font-weight-bold text-center">Information</p>
                                <p class="my-2 px-3 text-body-2">
                                    The maximum weekly bet is the amount you can play for 7 consecutive days. If you increase this limit it will only
                                    be effective after a 48 hour delay.
                                </p>
                                <v-btn class="my-2 px-3" block color="primary" @click="weaklyMaxBetInfo = false">OK</v-btn>
                            </v-card>
                        </v-dialog>
                        <p class="text-caption">You will be able to change this setting in your profile later.</p>
                        <v-btn block @click="step = 2">Continue</v-btn>
                    </div>
                    <div v-if="step === 2">
                        <p class="my-3 text-h5 font-weight-bold">How much do you want to deposit?</p>

                        <p class="my-3">
                            You can deposit up to <span class="font-weight-bold text-h4">€{{ selectedWeaklyMaxDeposit }}</span> per week.
                        </p>

                        <v-text-field
                            v-model="selectedDeposit"
                            label="Maximum weekly deposit"
                            type="number"
                            :rules="selectedDepositRules"
                            required
                            append-inner-icon="mdi-euros"
                        ></v-text-field>
                        <div>{{ Math.round(selectedWeaklyMaxDeposit / 4) }}</div>
                        <div>{{ Math.round(selectedWeaklyMaxDeposit / 3) }}</div>
                        <div>{{ Math.round(selectedWeaklyMaxDeposit / 2) }}</div>
                        <div>{{ Math.round(selectedWeaklyMaxDeposit / 1) }}</div>

                        <v-btn block @click="step = 3">Continue</v-btn>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
const selectedDeposit = ref<number>(10);
const selectedDepositRules = [
    (v: number) => !!v || 'A value is required',
    (v: number) => (v >= 10 && v <= selectedWeaklyMaxDeposit) || 'Select a value between 10€ and 5000€',
];
const selectedBettorLevel = ref<string>('Beginner');
const selectedWeaklyMaxDeposit = ref<number>(20);
const weaklyMaxDepositRules = [
    (v: number) => !!v || 'A value is required',
    (v: number) => (v >= 10 && v <= 5000) || 'Select a value between 10€ and 5000€',
];
const weaklyMaxDepositInfo = ref<boolean>(false);
const selectedWeaklyMaxBet = ref<number>(0);
const weaklyMaxBetRules = [
    (v: number) => !!v || 'A value is required',
    (v: number) => (v >= 10 && v <= 10000) || 'Select a value between 10€ and 10000€',
];
const weaklyMaxBetInfo = ref<boolean>(false);
const step = ref<number>(1);

const bettorLevels = [
    {
        id: 'Beginner',
        icon: 'mdi-emoticon',
        weaklyMaxDeposit: 200,
        weaklyMaxBet: 500,
    },
    {
        id: 'Amateur',
        icon: 'mdi-emoticon-cool',
        weaklyMaxDeposit: 500,
        weaklyMaxBet: 1000,
    },
    {
        id: 'Confirmed',
        icon: 'mdi-emoticon-devil',
        weaklyMaxDeposit: 5000,
        weaklyMaxBet: 10000,
    },
];
</script>

<style scoped>
.v-btn {
    text-transform: none;
}
</style>
