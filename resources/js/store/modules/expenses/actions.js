export default {



    async getExpenses(context,data) {

        console.log('Inside The Actions');


        // Extract token and attach to the request headers -> Bearer Token
        const token = context.rootGetters.token;
        console.log(token);
        const headers = {
            'Authorization' : `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
        const url = `https://building-management.test/api/expense`;


        const response = await fetch(url,{
            headers,

        });
        const responseData = await response.json();

        const expenses = responseData.data;
        console.log(expenses)
        if (!response.ok) {
            // Error
        }

        context.commit('getExpenses',expenses);


        // Get data from Vue component and send a request to the back-end

    },

    async addExpense(context,data) {

        console.log("Func found!");

        // Extract token and attach to the request headers -> Bearer Token
        const token = context.rootGetters.token;

        //console.log(/^function\s+([\w\$]+)\s*\(/.exec( func.toString() ));
        const headers = {
            'Authorization' : `Bearer ${token}`,
            'Content-Type': 'application/json'
        };
        const url = `https://building-management.test/api/expense`;
        const expenseData = {
            expense_name : data.expenseName,
            expense_for : data.paidFor,
            amount : data.amount,
            paid_at : data.paidAt,
            payment_method : data.paymentMethod

        }

        const response = await fetch(url,{
            headers,
            method : 'POST',
            body : JSON.stringify(expenseData)
        });

        const responseData = await response.json();


        const expense = responseData.data;

        console.log(expense);
        if (!response.ok) {
            // Error
        }

        context.commit('addExpense',expense);



    },

    async deleteExpense(context,data){

    }


}
