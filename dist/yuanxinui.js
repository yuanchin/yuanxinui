const e=()=>({actions:{clearable:{state:"none",transition:null,trigger:{"@click"(){this.actions.clearable.state="clear"},"@mousedown"(s){s.preventDefault()}}}},init(){this.$refs.yx_input_inner.addEventListener("focus",()=>{this.$refs.yx_input_wrapper.classList.remove("is-hover"),this.$refs.yx_input_wrapper.classList.add("is-focus"),this.$refs.yx_input_inner.value&&(this.actions.clearable.state="show")}),this.$refs.yx_input_inner.addEventListener("blur",()=>{this.$refs.yx_input_wrapper.classList.remove("is-focus"),this.actions.clearable.state="none"}),this.$refs.yx_input_inner.addEventListener("input",()=>{this.$refs.yx_input_inner.value===""&&(this.actions.clearable.state="none"),this.$refs.yx_input_inner.value&&(this.actions.clearable.state="show")}),this.$refs.yx_input_wrapper.addEventListener("mouseenter",()=>{this.$refs.yx_input.classList.contains("is-disabled")||this.$refs.yx_input_wrapper.classList.contains("is-focus")||(this.$refs.yx_input_wrapper.classList.add("is-hover"),this.$refs.yx_input_inner.value&&(this.actions.clearable.state="show"))}),this.$refs.yx_input_wrapper.addEventListener("mouseleave",()=>{this.$refs.yx_input.classList.contains("is-disabled")||this.$refs.yx_input_wrapper.classList.contains("is-focus")&&this.$refs.yx_input_inner.value||(this.$refs.yx_input_wrapper.classList.remove("is-hover"),this.actions.clearable.state="none")}),this.$watch("actions.clearable.state",s=>{switch(s){case"show":case"none":this.actions.clearable.transition=null;break;case"clear":this.actions.clearable.transition=()=>{this.$refs.yx_input_inner.value=""},this.actions.clearable.transition();break}})}});document.addEventListener("alpine:init",()=>{Alpine.data("yuanxinui_input",e)});
