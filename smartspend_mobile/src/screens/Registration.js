import React, { useState, useEffect } from "react";
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  ScrollView,
} from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { styles } from "../styles/Form";
import axios from "axios";
import { CheckBox } from "react-native-elements";

const Registration = ({ navigation }) => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [phone, setPhone] = useState("");
  const [address, setAddress] = useState("");
  const [dateOfBirth, setDateOfBirth] = useState("");
  const [age, setAge] = useState("");
  const [work, setWork] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [isChecked, setIsChecked] = useState(false);
  const [error, setError] = useState("");

  const toggleCheckbox = () => {
    setIsChecked(!isChecked);
  };

  useEffect(() => {
    checkToken();
  }, []);

  const checkToken = async () => {
    const token = await AsyncStorage.getItem("userToken");
    if (token) {
      navigation.navigate("Tab Navigator", { screen: "Overview" });
    }
  };

  const handleRegister = async () => {
    setError("");
    try {
      const response = await axios.post(
        `${"http://192.168.1.2:8000"}/api/users/register`,
        {
          first_name: firstName,
          last_name: lastName,
          phone: phone,
          address: address,
          phone: phone,
          date_of_birth: dateOfBirth,
          age: age,
          work: work,
          email: email,
          password: password,
          password_confirmation: passwordConfirmation,
        }
      );

      const { token, user } = response.data.response;

      await AsyncStorage.setItem("userToken", token);
      await AsyncStorage.setItem("userData", JSON.stringify(user));

      navigation.navigate("Tab Navigator", { screen: "Overview" });
    } catch (error) {
      setError("Invalid credentials");
    }
  };

  return (
    <ScrollView>
      <View style={[styles.container, { flex: 1, marginBottom: 30 }]}>
        <Text style={styles.title}>Hello!</Text>
        <Text style={styles.description}>Create a new account.</Text>
        {error !== "" && (
          <Text style={[styles.description, { color: "red" }]}>{error}</Text>
        )}
        <TextInput
          style={styles.input}
          placeholder="First name"
          value={firstName}
          onChangeText={(text) => setFirstName(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Last name"
          value={lastName}
          onChangeText={(text) => setLastName(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Phone"
          value={phone}
          onChangeText={(text) => setPhone(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Address"
          value={address}
          onChangeText={(text) => setAddress(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Date of birth"
          value={dateOfBirth}
          onChangeText={(text) => setDateOfBirth(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Age"
          value={age}
          onChangeText={(text) => setAge(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Work"
          value={work}
          onChangeText={(text) => setWork(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Email"
          value={email}
          onChangeText={(text) => setEmail(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Password"
          secureTextEntry
          value={password}
          onChangeText={(text) => setPassword(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Confirm Password"
          secureTextEntry
          value={passwordConfirmation}
          onChangeText={(text) => setPasswordConfirmation(text)}
        />
        <TouchableOpacity style={styles.inputButton} onPress={handleRegister}>
          <Text style={styles.inputButtonText}>Register</Text>
        </TouchableOpacity>

        <CheckBox
          title="I agree to the Terms & Conditions"
          checked={isChecked}
          onPress={toggleCheckbox}
          containerStyle={{ backgroundColor: "#f2f2f2", borderWidth: 0 }}
          textStyle={{ color: "#000" }}
        />

        <Text style={styles.inputText}>
          Already have an account?{" "}
          <Text
            style={styles.subInputText}
            onPress={() => navigation.navigate("Login")}
          >
            Sign in
          </Text>
        </Text>
      </View>
    </ScrollView>
  );
};

export default Registration;
