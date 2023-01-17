<template>
    <v-row no-gutters justify="center">
        <v-col cols="12" md="6" lg="4">
            <v-card class="pa-3 ma-3">
                <div class="text-center"><v-icon size="40">mdi-account-circle</v-icon></div>
                <p class="text-center font-weight-bold">Create an account</p>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field class="my-4" v-model="nickName" :rules="nickNameRules" :counter="10" label="Nickname" required></v-text-field>

                    <v-text-field class="my-4" v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>

                    <v-text-field class="my-4" v-model="password" label="Password" type="password" required></v-text-field>

                    <v-switch
                        v-model="checkbox"
                        :rules="[(v) => !!v || 'You must agree to continue!']"
                        label="I certify that I am over 18 years old. I have read and accept the Terms and Conditions and the Privacy Policy."
                        color="red"
                        value="red"
                        required
                    ></v-switch>

                    <v-btn color="success" class="mr-4" @click="validate"> Validate </v-btn>

                    <v-btn color="error" class="mr-4" @click="reset"> Reset Form </v-btn>
                </v-form>
            </v-card>
        </v-col>
    </v-row>
</template>

<script lang="ts" setup>
import { ref } from 'vue';

const form = ref();
const valid = ref(true);
const nickName = ref<string>('');
const nickNameRules = [
    (v: string) => !!v || 'Nickname is required',
    (v: string) => (v && v.length <= 10) || 'Nickname must be less than 10 characters',
];
const email = ref<string>('');
const emailRules = [(v: string) => !!v || 'E-mail is required', (v: string) => /.+@.+\..+/.test(v) || 'E-mail must be valid'];

const password = ref<string>('');

const checkbox = ref<boolean>(false);

async function validate() {
    const { valid } = await form.value.validate();

    if (valid) alert('Form is valid');
}

function reset() {
    form.value.reset();
}
</script>
