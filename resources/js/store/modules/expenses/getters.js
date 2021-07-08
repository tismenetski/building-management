export default {

    expenses (state) {

        return state.expenses;
    },

    hasExpenses(state) {
        return state.expenses && state.expenses.length > 0;
    }


}
