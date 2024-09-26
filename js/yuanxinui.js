import { input } from "./components/form/input";

document.addEventListener('alpine:init', () => {
    Alpine.data('yuanxinui_input', input);
});
