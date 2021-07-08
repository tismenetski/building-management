<template>
<table class="center">
    <thead>
        <td>
            Date Created
        </td>
        <td>
            Expense Name
        </td>
        <td>
            Paid For
        </td>
        <td>
            Amount
        </td>
        <td>
            Paid At
        </td>
        <td>
            Payment Method
        </td>
        <td>
            Expense Notes
        </td>
    </thead>
    <tbody v-for="expense in expenses">
    <tr>
        <td>{{expense.created_at}}</td>
        <td>{{expense.expense_name}}</td>
        <td>{{expense.expense_for}}</td>
        <td>{{expense.amount}}</td>
        <td>{{expense.paid_at}}</td>
        <td>{{expense.payment_method}}</td>
        <td>{{expense.expense_notes}}</td>
    </tr>
    </tbody>
</table>

    <base-button link :to="addExpense">Add Expense</base-button>
</template>

<script>
export default {
    name: "Expenses",
    data() {
        return {
            isLoading : false,
            error: null,
        }
    },
    computed : {

        isLoggedIn() {
            return this.$store.getters.isAuthenticated;
        },
        expenses(){
            const expenses = this.$store.getters['expenses/expenses'];
            console.log(expenses);
            return expenses;
        },
        addExpense() {
            return `${this.$route.path}/addExpense`;
        },
    },
    methods :{

        async loadExpenses(){
            this.isLoading = true;

            try {
                await this.$store.dispatch('expenses/getExpenses');

            }catch (e) {
                this.error = e.message || 'Something went wrong';
            }
            this.isLoading = false;
        }
    },

    created() {
        this.loadExpenses();
        console.log(this.expenses);
    }
}
</script>

<style scoped>

:root{
    --primary-color : #31708E;
}


.center {

    margin: 0 auto;
}

 td {
    border: 1px solid black;
     text-align: center;
}

 thead > td {
     font-size: 20px;
     color: var( --primary-color);
 }

table {
    width: 100%;
}
</style>
