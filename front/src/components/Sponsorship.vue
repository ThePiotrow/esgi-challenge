<template>
    <v-container>
        <v-card>
            <v-container>
                <v-row justify="center" class="pt-4">
                    <v-col cols="10">
                        <v-form v-model="valid" ref="form">
                            <v-text-field 
                                autofocus
                                v-model="email" 
                                @keydown.enter.prevent="sendSponsoLink" 
                                hint="Press enter to send the invitation"
                                placeholder="Enter the mail that you want to be sponsored"
                                type="email"
                                :rules="rules.email"
                                append-icon="mdi-send"
                                @click:append="sendSponsoLink"
                                lazy-validation
                            >
                            </v-text-field>
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </v-container>
</template>
<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../stores/user';
import { useSponsorshipStore } from '../stores/sponsorship';
import { SponsorshipI } from '../interfaces/payload';
import { createToast } from 'mosha-vue-toastify';

export default defineComponent({
    setup() {
        const userStore = useUserStore();
        const { getUsers } = userStore;
        const { users, user } = storeToRefs(userStore);

        const sponsorshipStore = useSponsorshipStore();
        const { addSponsorship } = sponsorshipStore;

        const email = ref<string>('');
        const valid = ref<boolean>();
        const form = ref();

        const rules = {
            email: [(v: string) => !!v || 'E-mail is required', (v: string) => /.+@.+\..+/.test(v) || 'E-mail must be valid']
        }

        onMounted(async () => {
            try {
                await getUsers();
            } catch (error) {
                
            }
        })

        const sendSponsoLink = async (event: any) => {
            const { valid } = await form.value.validate();
            if (valid) {
                try {
                    const payload: SponsorshipI = {
                        sponsor: user.value.id,
                        sponsored: email.value
                    }
                    await addSponsorship(payload);
                } catch {
                    createToast('Error while sending sponsorship link', { type: 'danger', position: 'bottom-right' });
                }
                email.value = "";
                event.target.blur();
                form.value.reset();
            }
        }

        return { email, sendSponsoLink, valid, rules, form, users }
    }
});
</script>