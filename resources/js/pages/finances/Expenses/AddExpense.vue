<template>

    <form @submit.prevent="submitForm" class="add-expense">
        <div class="form-control">
            <label for="expenseName">Expense Name</label>
            <input type="text" name="" id="expenseName" v-model.trim="expenseName.val">
        </div>
        <div class="form-control">
            <label for="paidFor">Paid For</label>
            <input type="text" name="" id="paidFor" v-model.trim="paidFor.val">
        </div>
        <div class="form-control">
            <label for="amount">Amount</label>
            <input type="number" name="" id="amount" v-model.number="amount.val">
        </div>
        <div class="form-control">
            <label for="paidAt">Paid At</label>
            <input type="date" name="" id="paidAt" min="2020-01-01" :max="maxDate" v-model.trim="paidAt.val">
        </div>
        <div class="form-control">
            <label for="paymentMethod">Payment Method</label>
            <input type="text" name="" id="paymentMethod" v-model.trim="paymentMethod.val">
        </div>
        <div class="form-control">
            <label for="expenseNotes">Expense Notes</label>
            <textarea name="" id="expenseNotes" cols="30" rows="10" v-model.trim="expenseNotes.val"></textarea>
        </div>
        <base-button>Submit</base-button>
    </form>

</template>

<script>

export default {
    name: "AddExpense",
    data(){
        return {
            expenseName : {
                val : '',
                isValid : true,

            },
            paidFor : {
                val : '',
                isValid : true,

            },
            amount : {
                val : null,
                isValid : true,

            },
            paidAt : {
                val : '',
                isValid : true,

            },
            paymentMethod : {
                val : '',
                isValid : true
            },
            expenseNotes : {
                val : '',
                isValid : true
            },
            formIsValid : true

        }
    },

    computed : {
        maxDate() {
            const date =  Date.now();

            console.log(date);
        }
    },
    methods : {
        clearValidity(input) {
            this[input].isValid  = true;
        },
        validateForm() {
            this.formIsValid = true;
            if (this.expenseName.val === '') {
                this.expenseName.isValid = false;
                this.formIsValid = false;
            }
            if (this.paidFor.val === '') {
                this.paidFor.isValid = false;
                this.formIsValid = false;
            }
            if (this.amount.val === null || this.amount.val  <= 0) {
                this.expenseName.isValid = false;
                this.formIsValid = false;
            }
            if (this.paidAt.val === '') { // todo Validate the date string
                this.paidAt.isValid = false;
                this.formIsValid = false;
            }
            if (this.paymentMethod.val === '') {
                this.paymentMethod.isValid = false;
                this.formIsValid = false;
            }
        },
        submitForm() {
            console.log("Submitting form");
            this.validateForm();
            if (!this.formIsValid) {
                return;
            }
            const formData = {
                expenseName : this.expenseName.val,
                paidFor : this.paidFor.val,
                amount : this.amount.val,
                paidAt : this.paidAt.val,
                paymentMethod: this.paymentMethod.val,
                expenseNotes : this.expenseNotes.val
            }

            try {
                this.$store.dispatch('expenses/addExpense', formData);
                this.$router.replace('/expenses');
            }catch (e) {
                this.error = e.message || 'Something went wrong';
            }

        }
    }
}
</script>

<style scoped>

.add-expense {
    /*margin : 0 auto;*/
    margin: 10rem auto;
    max-width: 40rem;
}

.form-control {
    margin : 8px auto;
}
label {
    font-weight: bold;
    display: block;
    margin-bottom: 0.5rem;
}

input,
textarea {
    display: block;
    width: 100%;
    border: 1px solid #ccc;
    font: inherit;
    border-radius: 5px;
}

input:focus,
textarea:focus {
    background-color: #f0e6fd;
    outline: none;
    border-color: #3d008d;
}

input[type='checkbox'] {
    display: inline;
    width: auto;
    border: none;
}

input[type='checkbox']:focus {
    outline: #3d008d solid 1px;
}

h3 {
    margin: 0.5rem 0;
    font-size: 1rem;
}

.invalid label {
    color: red;
}

.invalid input,
.invalid textarea {
    border: 1px solid red;
}

</style>
