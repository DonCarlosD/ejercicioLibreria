// assets/controllers/lang_switch_controller.js
import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    switch(event) {
        event.preventDefault();
        location.replace(this.element.href);
    }
}