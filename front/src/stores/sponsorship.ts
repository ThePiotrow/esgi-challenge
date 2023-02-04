import { defineStore } from "pinia";
import { SponsorshipI } from "../interfaces/payload";
import { ref } from "vue";
import { sponsorshipService } from "../service/api";
import { SponsorshipResponseI } from "../interfaces/responseAPI";

export const useSponsorshipStore = defineStore('sponsorship', () => {

    const sponsorship = ref<SponsorshipResponseI>();
    const sponsorships = ref<SponsorshipResponseI[]>([]);

    async function addSponsorship(payload: SponsorshipI) {
        try {
            const res = await sponsorshipService._addSponsorship(payload);
            sponsorships.value.push(res);
        } catch (error) {
            throw error;
        }
    }

    async function getSponsorships() {
        try {
            const res = await sponsorshipService._getSponsorships();
            sponsorships.value = res;
        } catch (error) {
            throw error;
        }
    }

    async function getSponsorship(id: string) {
        try {
            const res = await sponsorshipService._getSponsorship(id);
            sponsorship.value = res;
        } catch (error) {
            throw error;
        }
    }

    return { addSponsorship, getSponsorships, getSponsorship }
});