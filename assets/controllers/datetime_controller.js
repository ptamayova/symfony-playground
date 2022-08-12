import { Controller } from '@hotwired/stimulus';
import { DateTimeHelpers } from "../helpers/datetime_helpers";
import axios from 'axios';

export default class extends Controller {
    static values = {
        infoUrl: String
    }

    update() {
        axios.get(this.infoUrlValue)
            .then((response) => {
                let datetimeElement = document.getElementById('datetime');
                datetimeElement.textContent = response.data.time;
            });
    }
}