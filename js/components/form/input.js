export const input = () => ({
    actions: {
        clearable: {
            state: 'none',
            transition: null,
            trigger: {
                ['@click']() {
                    this.actions.clearable.state = 'clear';
                },

                ['@mousedown'](e) {
                    e.preventDefault();
                }
            }
        }
    },

    init () {
        this.$refs['yx_input_inner'].addEventListener('focus', () => {
            this.$refs['yx_input_wrapper'].classList.remove('is-hover');
            this.$refs['yx_input_wrapper'].classList.add('is-focus');

            if (this.$refs['yx_input_inner'].value) {
                this.actions.clearable.state = 'show';
            }
        });

        this.$refs['yx_input_inner'].addEventListener('blur', () => {
            this.$refs['yx_input_wrapper'].classList.remove('is-focus');

            this.actions.clearable.state = 'none';
        });

        this.$refs['yx_input_inner'].addEventListener('input', () => {
            if (this.$refs['yx_input_inner'].value === '') {
                this.actions.clearable.state = 'none';
            }

            if (this.$refs['yx_input_inner'].value) {
                this.actions.clearable.state = 'show';
            }
        });

        this.$refs['yx_input_wrapper'].addEventListener('mouseenter', () => {
            if (
                this.$refs['yx_input'].classList.contains('is-disabled') ||
                this.$refs['yx_input_wrapper'].classList.contains('is-focus')
            ) return;

            this.$refs['yx_input_wrapper'].classList.add('is-hover');

            if (this.$refs['yx_input_inner'].value) {
                this.actions.clearable.state = 'show';
            }
        });

        this.$refs['yx_input_wrapper'].addEventListener('mouseleave', () => {
            if (
                this.$refs['yx_input'].classList.contains('is-disabled') ||
                (
                    this.$refs['yx_input_wrapper'].classList.contains('is-focus') &&
                    this.$refs['yx_input_inner'].value
                )
            ) return;

            this.$refs['yx_input_wrapper'].classList.remove('is-hover');

            this.actions.clearable.state = 'none';
        });

        this.$watch('actions.clearable.state', (value) => {
            switch (value) {
                case 'show':
                case 'none':
                    this.actions.clearable.transition = null;
                    break;
                case 'clear':
                    this.actions.clearable.transition = () => {
                        this.$refs['yx_input_inner'].value = '';
                    };

                    this.actions.clearable.transition();
                    break;
            }
        });
    }
});
