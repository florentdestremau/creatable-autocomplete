// assets/controllers/custom-autocomplete_controller.js
import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        url: String
    }

    connect() {
        this.element.addEventListener('autocomplete:pre-connect', this._onPreConnect);
    }

    disconnect() {
        // You should always remove listeners when the controller is disconnected to avoid side-effects
        this.element.removeEventListener('autocomplete:pre-connect', this._onPreConnect());
    }

    _onPreConnect = (event) => {
        const url = this.urlValue;
        event.detail.options.create = function (input, callback) {
            const data = new FormData();
            data.append('name', input);
            fetch(url, {
                method: 'POST',
                body: data,
            })
                .then(response => response.json())
                .then(data => callback({value: data.id, text: data.name}));
        }
    }
}
