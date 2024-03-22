import React, { useState, useEffect } from "react";
import {
  View,
  Text,
  TouchableOpacity,
  ScrollView,
  Image,
  StyleSheet,
  RefreshControl,
} from "react-native";
import { Ionicons } from "@expo/vector-icons";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";

const Plans = ({ navigation }) => {
  const [refreshing, setRefreshing] = useState(false);
  const [learningFeatures, setLearningFeatures] = useState([]);
  const [render, setRender] = useState(null);
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
    salary: "",
    work: "",
    created_at: null,
    updated_at: null,
  });

  useEffect(() => {
    fetchData();
    getUserData();
  }, [render]);

  const fetchData = async () => {
    try {
      setRefreshing(true);
      const token = await AsyncStorage.getItem("userToken");
      const response = await axios.get(
        `${"https://smart-spend.online"}/api/users/plans`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      setLearningFeatures(response.data.plans);
    } catch (error) {
      console.log(error);
    } finally {
      setRefreshing(false);
    }
  };

  const handleDelete = async (item) => {
    try {
      const token = await AsyncStorage.getItem("userToken");

      const response = await axios.delete(
        `${"https://smart-spend.online"}/api/users/user-plan/${
          item.plan[0].id
        }`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      setRender(response);
    } catch (error) {
      console.log(error);
    }
  };

  const handleApply = async (item) => {
    try {
      const token = await AsyncStorage.getItem("userToken");

      const response = await axios.post(
        `${"https://smart-spend.online"}/api/users/user-plan/add`,
        {
          plan_id: item.id,
          status: "status",
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      setRender(response);
    } catch (error) {
      console.log(error);
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
      <View style={styles.container}>
        <View style={styles.containerHeader}>
          <Text style={styles.titleHeader}>Plans</Text>
        </View>
        {learningFeatures.map((item) => (
          <View style={styles.containerContent} key={item.id}>
            <View style={styles.contents}>
              <View style={{ width: "100%" }}>
                <Text style={{ marginLeft: 5, marginBottom: 10 }}>
                  <Text style={{ fontWeight: "bold" }}>Title: </Text>
                  {item.title}
                </Text>
                <Text style={{ marginLeft: 5, marginBottom: 10 }}>
                  <Text style={{ fontWeight: "bold" }}>Minimum Salary: </Text>
                  <Text
                    style={{
                      color:
                        item.minimum_salary > userData.salary ? "red" : "green",
                    }}
                  >
                    {item.minimum_salary}
                  </Text>
                </Text>
                <Text style={{ marginLeft: 5, marginBottom: 10 }}>
                  <Text style={{ fontWeight: "bold" }}>Minimum Age: </Text>
                  <Text
                    style={{
                      color: item.minimum_age > userData.age ? "red" : "green",
                    }}
                  >
                    {item.minimum_age}
                  </Text>
                </Text>
                <Text style={{ marginLeft: 5, marginBottom: 10 }}>
                  <Text style={{ fontWeight: "bold" }}>Cost: </Text>
                  <Text>{item.cost}</Text>
                </Text>
                <Text style={{ marginLeft: 5, marginBottom: 10 }}>
                  <Text style={{ fontWeight: "bold" }}>Months: </Text>
                  <Text>{item.months}</Text>
                </Text>
                {item.minimum_salary <= userData.salary &&
                  item.minimum_age <= userData.age && (
                    <TouchableOpacity
                      style={styles.buttonContainer}
                      onPress={() =>
                        item.plan.length > 0 &&
                        item.plan[0].plan_id === item.id &&
                        item.plan[0].user_id === userData.id
                          ? handleDelete(item)
                          : handleApply(item)
                      }
                    >
                      <Text style={styles.buttonText}>
                        {item.plan.length > 0 &&
                        item.plan[0].plan_id === item.id &&
                        item.plan[0].user_id === userData.id
                          ? "Delete"
                          : "Apply"}
                      </Text>
                    </TouchableOpacity>
                  )}
                <TouchableOpacity
                  style={styles.buttonContainer}
                  onPress={() =>
                    navigation.navigate("Plan", {
                      item: item,
                    })
                  }
                >
                  <Text style={styles.buttonText}>View</Text>
                </TouchableOpacity>
              </View>
            </View>
          </View>
        ))}
        {/* <View style={styles.containerContent}>
          <View style={styles.contents}>
            <View style={{ flexDirection: "row", alignItems: "center" }}>
              <Text style={{ fontWeight: "bold" }}>Section 2:</Text>
              <Text style={{ marginLeft: 5 }}>Description</Text>
            </View>
            <View>
              <Ionicons
                name="md-arrow-down-circle-sharp"
                size={24}
                color="black"
              />
            </View>
          </View>
          <View style={[styles.contents, { paddingVertical: 10 }]}>
            <Text>1. 70-20-10 budget principle</Text>
            <Ionicons name="eye" size={24} color="blue" />
          </View>
        </View> */}
      </View>
    </ScrollView>
  );
};

export default Plans;

const styles = StyleSheet.create({
  container: {
    marginLeft: 20,
    marginRight: 20,
  },
  containerHeader: {
    backgroundColor: "#EFEFEF",
    justifyContent: "center",
    alignItems: "center",
    paddingTop: 5,
    paddingBottom: 5,
    paddingRight: 20,
    paddingLeft: 20,
    marginTop: 10,
    marginBottom: 10,
    borderRadius: 10,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
  },
  containerImage: {
    padding: 15,
    backgroundColor: "#fff",
    marginVertical: 10,
    borderRadius: 20,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    maxHeight: 500,
  },
  containerContent: {
    backgroundColor: "#fff",
    paddingVertical: 15,
    borderRadius: 10,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    marginVertical: 3,
  },
  titleHeader: {
    fontWeight: "bold",
  },
  image: { width: "100%", height: 300, borderRadius: 20 },
  contents: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    paddingHorizontal: 20,
  },
  buttonContainer: {
    backgroundColor: "#41DC40",
    borderRadius: 10,
    padding: 10,
    alignItems: "center",
    justifyContent: "center",
    marginTop: 8,
    width: "100%",
  },
  buttonText: {
    color: "white",
    fontSize: 16,
    fontWeight: "bold",
  },
});
