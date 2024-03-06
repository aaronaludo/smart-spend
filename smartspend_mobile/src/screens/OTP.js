import React from "react";
import { View, Text, TextInput, TouchableOpacity } from "react-native";
import { styles } from "../styles/Form";

const OTP = ({ navigation }) => {
  return (
    <>
      <View style={[styles.container, { flex: 1 }]}>
        <Text style={styles.title}>Verify your Email!</Text>
        <Text style={styles.description}>
          Enter the code below to confirm{" "}
          <Text style={{ textDecorationLine: "underline", color: "blue" }}>
            aaron@example.com
          </Text>
        </Text>
        <TextInput style={styles.input} placeholder="Enter Code" />
        <TouchableOpacity
          style={styles.inputButton}
          onPress={() => navigation.navigate("Overview")}
        >
          <Text style={styles.inputButtonText}>Submit</Text>
        </TouchableOpacity>
        <Text style={styles.inputText}>
          Did not receive a code{" "}
          <Text
            style={styles.subInputText}
            onPress={() => navigation.navigate("Registration")}
          >
            Re-send
          </Text>
        </Text>
      </View>
    </>
  );
};

export default OTP;
