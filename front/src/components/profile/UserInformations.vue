<template>
    <div class="pa-10 lg:w-1/2 border ma-auto">
        <h1 class="text-2xl font-bold pb-5">Personnal informations</h1>

        <v-form v-model="valid" ref="form">
            <v-text-field v-model="user.username" :rules="[rules.required]" placeholder="username" label="username"></v-text-field>
            <v-text-field v-model="user.email" disabled label="email"></v-text-field>
            <v-btn block color="primary" @click="validate()">Confirm</v-btn>
        </v-form>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useUserStore } from "../../stores/user";
import { storeToRefs } from 'pinia';
import { createToast } from "mosha-vue-toastify";
export default defineComponent({
setup() {
    const userStore = useUserStore();
    const { user } = storeToRefs(userStore);
    const { updateUser } = userStore;

    const form = ref();
    const valid = ref<boolean>(false);

    const rules = {
        required: (v: string) => !!v || 'Value required'
    }

    const validate = async () => {
        try {
            const { valid } = await form.value.validate();
            if (valid) {
                await updateUser();
                createToast("User updated", { type: 'success', position: 'bottom-right' });
            }

        } catch (error) {
            createToast("Passwords incorrect", { type: 'danger', position: 'bottom-right' });
        }
    }

    return { user, validate, form, valid, rules }
}
});
</script>