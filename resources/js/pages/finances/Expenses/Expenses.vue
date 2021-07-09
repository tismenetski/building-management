<template>
    <h1 class="title">Building Expenses</h1>
<div class="expense-totals">

    <table  class="center">
        <thead>
        <td></td>
        </thead>
    </table>

</div>


<table  class="center">
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
    <tbody>

    <tr v-for="expense in expenses">
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

.title {
    margin: 15vh auto 0 auto;
    text-align: center;
    color : #3e0748;
}

.center {
    margin: 10vh auto;
    border-spacing: 0px;

}

.center  td {
    border-bottom: 1pt solid black;
     text-align: center;
     font-size: 12px;
    padding: 0;
}

.center thead  td {
    border-bottom: 1pt solid black;
    text-align: center;
    font-size: 16px;
}
table {

    border: 1px solid black;
    /*border-collapse: collapse;*/
    overflow: hidden;
    /*table-layout: auto;*/
    width: 1200px;
}
</style>
