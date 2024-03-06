import React from "react";
import Box from "../components/Box";
import {
  View,
  Text,
  TouchableOpacity,
  StyleSheet,
  Dimensions,
  ScrollView,
} from "react-native";
import { styles } from "../styles/Box";
import { LineChart } from "react-native-chart-kit";

const screenWidth = Dimensions.get("window").width;

const data = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
  datasets: [
    {
      data: [20, 45, 28, 80, 99, 43],
      color: (opacity = 1) => `#000000`, // sets the color for the line
      strokeWidth: 2, // optional, sets the line thickness
    },
  ],
};

export default function Monthly({ navigation }) {
  return (
    <ScrollView>
      <View style={styles.container}>
        <Text style={styles.title}>Add your monthly Expenses</Text>
        <Text style={styles.description}>
          Pro Tip: Start with fixed expenses, and then add flexible expenses
        </Text>
        <View style={styless.container}>
          <LineChart
            data={data}
            width={screenWidth - 80}
            height={220}
            yAxisLabel={"$"}
            chartConfig={{
              backgroundColor: "#41DC40",
              backgroundGradientFrom: "#41DC40",
              backgroundGradientTo: "#41DC40",
              decimalPlaces: 2,
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
        <TouchableOpacity
          style={styles.buttonContainer}
          onPress={() =>
            navigation.navigate("Expenses", {
              result: "",
            })
          }
        >
          <Text style={styles.buttonText}>Create</Text>
        </TouchableOpacity>
        <View style={_styles.container}>
          <Text style={_styles.containerText}>Example of Expenses</Text>
          <View style={_styles.containerDetails}>
            <Text style={_styles.containerDetailsText}>House Rent</Text>
            <Text style={_styles._containerDetailsText}>₱ 000,000,000.00</Text>
          </View>
          <View style={_styles.containerDetails}>
            <Text style={_styles.containerDetailsText}>House Rent</Text>
            <Text style={_styles._containerDetailsText}>₱ 000,000,000.00</Text>
          </View>
        </View>
      </View>
      <View style={styles.container}>
        <Text style={styles.title}>Add your monthly Income</Text>
        <Text style={styles.description}>Add your new source of income.</Text>
        <View style={styless.container}>
          <LineChart
            data={data}
            width={screenWidth - 80}
            height={220}
            yAxisLabel={"$"}
            chartConfig={{
              backgroundColor: "#41DC40",
              backgroundGradientFrom: "#41DC40",
              backgroundGradientTo: "#41DC40",
              decimalPlaces: 2,
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
        <TouchableOpacity
          style={styles.buttonContainer}
          onPress={() =>
            navigation.navigate("Incomes", {
              result: "",
            })
          }
        >
          <Text style={styles.buttonText}>Create</Text>
        </TouchableOpacity>
        <View style={_styles.container}>
          <Text style={_styles.containerText}>Example of Income</Text>
          <View style={_styles.containerDetails}>
            <Text style={_styles.containerDetailsText}>Investment</Text>
            <Text style={_styles._containerDetailsText}>₱ 000,000,000.00</Text>
          </View>
          <View style={_styles.containerDetails}>
            <Text style={_styles.containerDetailsText}>Investment</Text>
            <Text style={_styles._containerDetailsText}>₱ 000,000,000.00</Text>
          </View>
          <View style={_styles.containerDetails}>
            <Text style={_styles.containerDetailsText}>Investment</Text>
            <Text style={_styles._containerDetailsText}>₱ 000,000,000.00</Text>
          </View>
        </View>
      </View>
    </ScrollView>
  );
}

const _styles = StyleSheet.create({
  container: {
    justifyContent: "center",
    alignItems: "center",
    marginBottom: 20,
    marginTop: 20,
  },
  containerText: {
    fontSize: 20,
  },
  containerDetails: {
    flexDirection: "row",
    justifyContent: "space-evenly",
    width: "100%",
    marginTop: 15,
  },
  containerDetailsText: {
    fontWeight: "bold",
    fontSize: 15,
  },
  _containerDetailsText: {
    fontSize: 15,
  },
});

const styless = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    marginLeft: 40,
    marginRight: 40,
    marginBottom: 15,
    marginTop: 15,
  },
});
