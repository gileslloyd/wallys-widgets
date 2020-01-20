<template>

    <section>

        <div id="calculation-form">
            <div class="calculation-card">

                <div class="card-title">
                    <h1>Calculate the Pack Allocation</h1>
                </div>

                <div class="content">
                    <form method="POST" action="" @submit.prevent="calculatePackAllocation">

                        <input id="number_of_widgets" type="number" name="number_of_widgets" title="number_of_widgets" placeholder="How Many Widgets?" v-model="number_of_widgets" required autofocus>

                        <button type="submit" class="btn btn-primary">Calculate Pack Allocation</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="notification is-info" v-show="resultIsVisible">
            <button class="delete" @click="resultIsVisible = false"></button>
            <span>{{ info }}</span>
        </div>

    </section>

</template>

<script>
    import ApiClient from './../classes/apiclient.js';

    export default {

        name: 'Home',

        data() {
            return {
                number_of_widgets: '',
                resultIsVisible: false,
                info: ''
            }
        },

        methods: {
            calculatePackAllocation() {
                let self = this;
                this.info = 'Calculating....';
                this.resultIsVisible = true;

                ApiClient.get(
                    'packs?widgets='+self.number_of_widgets,
                    (response) => {
                        self.displayPackAllocation(response.data.data.allocatedPacks);
                        self.number_of_widgets = '';
                    },
                    (error) => {
                        self.error = error.response.data.body.error;
                        self.validationFailed = true;
                    }
                );
            },
            displayPackAllocation(packs) {
                let info = 'The following packs will fulfill this order: ';
                for (let pack in packs) {
                    info += packs[pack].number + 'x' + packs[pack].packSize + ', ';
                }

                this.info = info.slice(0, -2);
            }
        }

    };

</script>

<style scoped>

    #calculation-form {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F7F7F7;
        overflow: hidden;
        padding: 2em;
    }

    .calculation-card {
        background: #fff;
        width: 24rem;
        box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.11);
    }

    .card-title {
        background-color: #00b89c;
        padding: 2rem;
    }

    h1 {
        color: #fff;
        text-align: center;
        font-size: 1.2rem;
    }

    .content {
        padding: 2rem 2.5rem 5rem;
    }

    input {
        display: block;
        width: 100%;
        font-size: 1rem;
        margin-bottom: 1.75rem;
        padding: 0.25rem 0;
        border: none;
        border-bottom: 1px solid hsl(0, 0%, 86%);
        transition: all .5s;
    }

    span {
        margin-left: 0.5rem;
    }

    a {
        font-size: 0.8rem;
    }

    button {
        cursor: pointer;
        font-size: 1.2rem;
        color: hsl(171, 100%, 41%);
        border-radius: 4rem;
        display: block;
        width: 100%;
        background: transparent;
        border: 2px solid hsl(171, 100%, 41%);
        padding: 0.9rem 0 1.1rem;
        transition: color .5s, border-color .5s;
    }

    label {
        cursor: pointer;
    }

    input:focus,
    select:focus,
    textarea:focus,
    button:focus {
        outline: none;
    }

    .notification {
        position: fixed;
        width: 40%;
        height: 30%;
        top: 30%;
        left: 30%;
    }

</style>
