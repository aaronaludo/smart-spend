import React, { useState, useEffect } from "react";
import {
  StyleSheet,
  Text,
  View,
  ScrollView,
  RefreshControl,
} from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";

export default function Notification() {
  const [refreshing, setRefreshing] = useState(false);
  const [notifications, setNotifications] = useState([]);
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
        `${"http://192.168.1.5:8000"}/api/users/notifications`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      setNotifications(response.data.notifications);
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
      {notifications.map((item) => (
        <>
          <View style={styles2.container}>
            <Text style={styles2.title}>{item.date}</Text>
          </View>
          {item.notifications.map((item2) => (
            <View style={styles.container} key={item2.id}>
              <View style={styles.titleContainer}>
                <Text style={styles.title}>{item2.title}</Text>
                <Text style={styles.description}>{item2.date}</Text>
              </View>
              <Text style={styles.description}>{item2.description}</Text>
            </View>
          ))}
        </>
      ))}
    </ScrollView>
  );
}

const styles2 = StyleSheet.create({
  container: {
    backgroundColor: "#EFEFEF",
    justifyContent: "center",
    alignItems: "center",
    paddingTop: 5,
    paddingBottom: 5,
    paddingRight: 20,
    paddingLeft: 20,
    marginTop: 10,
    marginLeft: 20,
    marginRight: 20,
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
  title: {
    fontWeight: "bold",
  },
});

const styles = StyleSheet.create({
  container: {
    backgroundColor: "#fff",
    justifyContent: "center",
    paddingTop: 20,
    paddingBottom: 20,
    paddingRight: 20,
    paddingLeft: 20,
    marginTop: 10,
    marginBottom: 10,
    marginLeft: 20,
    marginRight: 20,
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
  titleContainer: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    marginBottom: 10,
  },
  title: {
    fontWeight: "bold",
  },
  description: {
    color: "grey",
    fontSize: 12,
  },
});
