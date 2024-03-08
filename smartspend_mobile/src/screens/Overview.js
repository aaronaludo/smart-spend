import React, { useState, useEffect } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";
import Box from "../components/Box";
import { styles } from "../styles/Box";
import axios from "axios";
import {
  Text,
  View,
  StyleSheet,
  Dimensions,
  ScrollView,
  RefreshControl,
} from "react-native";
import { LineChart } from "react-native-chart-kit";

const screenWidth = Dimensions.get("window").width;

const data = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
  datasets: [
    {
      data: [20, 45, 28, 80, 99, 43],
      color: (opacity = 1) => `#000000`,
      strokeWidth: 2,
    },
  ],
};

const Overview = ({ navigation }) => {
  const [income, setIncome] = useState(0);
  const [expense, setExpense] = useState(0);
  const [refreshing, setRefreshing] = useState(false);

  const [userData, setUserData] = useState({
    id: null,
    role_id: null,
    image: "",
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    address: "",
    date_of_birth: "",
    age: 0,
    work: "",
    created_at: null,
    updated_at: null,
  });

  useEffect(() => {
    fetchData();
    getUserData();
  }, []);

  const fetchData = async () => {
    try {
      setRefreshing(true);
      const token = await AsyncStorage.getItem("userToken");
      const response = await axios.get(
        `${"http://192.168.6.142:8000"}/api/users/overview`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      setIncome(response.data.incomes);
      setExpense(response.data.expenses);
    } catch (error) {
      console.log(error);
    } finally {
      setRefreshing(false);
    }
  };

  const getUserData = async () => {
    try {
      const storedUserData = await AsyncStorage.getItem("userData");
      if (storedUserData) {
        const parsedUserData = JSON.parse(storedUserData);
        setUserData(parsedUserData);
      }
    } catch (error) {
      console.error("Error retrieving user data:", error);
    }
  };

  return (
    <ScrollView
      refreshControl={
        <RefreshControl refreshing={refreshing} onRefresh={fetchData} />
      }
    >
      <Box
        container={styles.container}
        title={styles.title}
        description={styles.description}
        titleLabel={`Welcome, ${userData.first_name} ${userData.last_name}`}
        descriptionLabel={`${userData.email}`}
      />
      <View style={styless.container}>
        <LineChart
          data={data}
          width={screenWidth - 40} // from react-native
          height={220}
          yAxisLabel={"$"}
          chartConfig={{
            backgroundColor: "#41DC40",
            backgroundGradientFrom: "#41DC40",
            backgroundGradientTo: "#41DC40",
            decimalPlaces: 2, // optional, defaults to 2dp
            color: (opacity = 1) => `grey`,
            labelColor: (opacity = 1) => `#fff`,
            style: {
              borderRadius: 16,
            },
            propsForDots: {
              r: "6",
              strokeWidth: "2",
              stroke: "#ffffff",
            },
          }}
          bezier
          style={{
            marginVertical: 0,
            borderRadius: 16,
          }}
        />
      </View>
      <Box
        container={styles.container}
        title={styles.title}
        description={styles.description}
        titleLabel="Income"
        descriptionLabel={`₱ ${income}`}
      />
      <Box
        container={styles.container}
        title={styles.title}
        description={styles.description}
        titleLabel="Expenses"
        descriptionLabel={`₱ ${expense}`}
      />
    </ScrollView>
  );
};

const styless = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    marginLeft: 20, // Adjust margin as needed
    marginRight: 20, // Adjust margin as needed
  },
});

export default Overview;
