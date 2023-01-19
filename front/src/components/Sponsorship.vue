<template>
    <v-container>
        <v-form v-model="valid" ref="form">
            <v-text-field 
                autofocus
                v-model="email" 
                @keydown.enter.prevent="sendSponsoLink" 
                hint="Press enter to send the invitation"
                placeholder="Enter the mail that you want to be sponsored"
                type="text"
                :rules="rules.email"
                prepend-inner-icon="mdi-send"
            >
            </v-text-field>
        </v-form>
    </v-container>
</template>
<script lang="ts">
import { defineComponent, ref } from 'vue';
export default defineComponent({
    setup() {
        const email = ref<string>('');
        const valid = ref<boolean>();
        const form = ref();

        const rules = {
            email: [(v: string) => !!v || 'E-mail is required', (v: string) => /.+@.+\..+/.test(v) || 'E-mail must be valid']
        }

        const sendSponsoLink = async () => {
            const { valid } = await form.value.validate();
            if (valid) {
                console.log('called')
                email.value = "";
                form.value.reset();
            }
        }

        return { email, sendSponsoLink, valid, rules, form }
    }
});
</script>