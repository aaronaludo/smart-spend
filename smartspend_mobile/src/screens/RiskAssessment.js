import React from "react";
import { styles } from "../styles/Box";
import { Text, View, ScrollView, TouchableOpacity } from "react-native";
import { CheckBox } from "react-native-elements";

const RiskAssessment = ({ navigation }) => {
  return (
    <>
      <ScrollView>
        <View style={styles.container}>
          <Text style={styles.title}>What is the capital of France?</Text>
          <CheckBox
            title="Option 1"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 2"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 3"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
        </View>
        <View style={styles.container}>
          <Text style={styles.title}>What is the capital of France?</Text>
          <CheckBox
            title="Option 1"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 2"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 3"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
        </View>
        <View style={styles.container}>
          <Text style={styles.title}>What is the capital of France?</Text>
          <CheckBox
            title="Option 1"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 2"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 3"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
        </View>
        <View style={styles.container}>
          <Text style={styles.title}>What is the capital of France?</Text>
          <CheckBox
            title="Option 1"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 2"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 3"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
        </View>
        <View style={styles.container}>
          <Text style={styles.title}>What is the capital of France?</Text>
          <CheckBox
            title="Option 1"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 2"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
          <CheckBox
            title="Option 3"
            containerStyle={{
              borderWidth: 0,
              padding: 0,
              margin: 0,
            }}
            textStyle={{ color: "#000", fontSize: 12, fontWeight: "600" }}
          />
        </View>
        <View style={styles.containerButton}>
          <TouchableOpacity style={styles.inputButton}>
            <Text style={styles.buttonText}>Submit</Text>
          </TouchableOpacity>
        </View>
      </ScrollView>
    </>
  );
};

export default RiskAssessment;
