// assets/controllers/custom-autocomplete_controller.js
import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.element.addEventListener('autocomplete:pre-connect', this._onPreConnect);
    }

    disconnect() {
        // You should always remove listeners when the controller is disconnected to avoid side-effects
        this.element.removeEventListener('autocomplete:pre-connect', this._onPreConnect());
    }

    _onPreConnect = (event) => {
        event.detail.options.create = function (input, callback) {
            const data = new FormData();
            data.append('attribute[name]', input);
            fetch('/attribute/new?ajax=1', {
                method: 'POST',
                body: data,
            })
                .then(response => response.json())
                .then(data => callback({value: data.id, text: data.name}));
        }
    }
}
