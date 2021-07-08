export default {

    getExpenses(state, payload) {
        console.log('Inside get Expenses Mutations');
        console.log(state)
        state.expenses = payload;
        console.log(state.expenses);
    },

    addExpense(state,payload) {
        state.expenses.push(payload);
    }

}
