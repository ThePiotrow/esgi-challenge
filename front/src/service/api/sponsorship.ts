import { SponsorshipI } from "../../interfaces/payload";
import { SponsorshipResponseI } from "../../interfaces/responseAPI";
import { client } from "../index";

const namespace = '/sponsorships'
class Sponsorship {

    async _getSponsorships(): Promise<SponsorshipResponseI[]> {
        try {
            
            const res = await client.get(namespace);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

    async _getSponsorship(sponsoId: string): Promise<SponsorshipResponseI> {
        try {
            const uri = `${namespace}/${sponsoId}`;
            const res = await client.get(uri);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 

    async _addSponsorship(payload: SponsorshipI): Promise<SponsorshipResponseI> {
        try {
            const res = await client.post(namespace, payload);
            return res.data;
        } catch (error) {
            throw error;
        }
    } 
}

const sponsorshipService = new Sponsorship();

export default sponsorshipService;