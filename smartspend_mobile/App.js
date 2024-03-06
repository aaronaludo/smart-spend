import * as React from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";
import TabNavigator from "./src/navigator/TabNavigator";
import Account from "./src/screens/Account";
import AccountInformation from "./src/screens/AccountInformation";
import ChangePassword from "./src/screens/ChangePassword";
import CreateBudget from "./src/screens/CreateBudget";
import LearningFeaturesContent from "./src/screens/LearningFeaturesContent";
import LearningFeaturesModule from "./src/screens/LearningFeaturesModule";
import Login from "./src/screens/Login";
import OTP from "./src/screens/OTP";
import Recommendation from "./src/screens/Recommendation";
import Registration from "./src/screens/Registration";
import RiskAssessment from "./src/screens/RiskAssessment";
import TapWidget from "./src/screens/TapWidget";
import Incomes from "./src/screens/Incomes";
import Expenses from "./src/screens/Expenses";
import AddIncome from "./src/screens/AddIncome";
import AddExpense from "./src/screens/AddExpense";
import EditIncome from "./src/screens/EditIncome";
import EditExpense from "./src/screens/EditExpense";

const Stack = createStackNavigator();

function AppNavigator() {
  return (
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen
          name="Login"
          component={Login}
          options={{ headerShown: false }}
        />
        <Stack.Screen
          name="Tab Navigator"
          component={TabNavigator}
          options={{ headerShown: false }}
        />
        <Stack.Screen name="Account" component={Account} />
        <Stack.Screen
          name="Account Information"
          component={AccountInformation}
        />
        <Stack.Screen name="Change Password" component={ChangePassword} />
        <Stack.Screen name="Create Budget" component={CreateBudget} />
        <Stack.Screen
          name="Learning Features Content"
          component={LearningFeaturesContent}
        />
        <Stack.Screen
          name="Learning Features Module"
          component={LearningFeaturesModule}
        />
        <Stack.Screen
          name="OTP"
          component={OTP}
          // options={{ headerShown: false }}
        />
        <Stack.Screen name="Recommendation" component={Recommendation} />
        <Stack.Screen
          name="Registration"
          component={Registration}
          // options={{ headerShown: false }}
        />
        <Stack.Screen name="Risk Assessment" component={RiskAssessment} />
        <Stack.Screen name="Tap Widget" component={TapWidget} />
        <Stack.Screen name="Incomes" component={Incomes} />
        <Stack.Screen name="Add Income" component={AddIncome} />
        <Stack.Screen name="Expenses" component={Expenses} />
        <Stack.Screen name="Add Expense" component={AddExpense} />
        <Stack.Screen name="Edit Expense" component={EditExpense} />
        <Stack.Screen name="Edit Income" component={EditIncome} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default AppNavigator;
