import React from "react";
import {
  StyleSheet,
  Text,
  View,
  TouchableOpacity,
  Dimensions,
  ScrollView,
} from "react-native";
import Box from "../components/Box";
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
      <Box
        container={styles.container}
        title={styles.title}
        description={styles.description}
        titleLabel="Monthly Budget"
        descriptionLabel="Create a budget to sharpen your spending and amplifying your savings"
        navigation={navigation}
        buttonContainer={styles.buttonContainer}
        buttonText={styles.buttonText}
        buttonTextLabel={"Create a Budget"}
        buttonNavigation={"Create Budget"}
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
        titleLabel="Monthly Cash flow"
        descriptionLabel="₱ 000,000,000.00"
      />
    </ScrollView>
  );
}

const styless = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    marginLeft: 20, // Adjust margin as needed
    marginRight: 20, // Adjust margin as needed
  },
});
