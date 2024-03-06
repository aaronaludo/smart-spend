import React from "react";
import {
  View,
  Text,
  TouchableOpacity,
  ScrollView,
  Image,
  StyleSheet,
} from "react-native";
import { Ionicons } from "@expo/vector-icons";

const LearningFeatureModule = () => {
  return (
    <ScrollView>
      <View style={styles.container}>
        <View style={styles.containerHeader}>
          <Text style={styles.titleHeader}>Module</Text>
        </View>
        <View style={styles.containerImage}>
          <Image
            source={require("../../assets/images/learn.jpg")}
            style={styles.image}
            resizeMode="contain"
          />
        </View>
        <View style={styles.containerContent}>
          <View style={styles.contents}>
            <View style={{ flexDirection: "row", alignItems: "center" }}>
              <Text style={{ fontWeight: "bold" }}>Section 1:</Text>
              <Text style={{ marginLeft: 5 }}>Introduction</Text>
            </View>
            <View>
              <Ionicons
                name="md-arrow-forward-circle-sharp"
                size={24}
                color="black"
              />
            </View>
          </View>
        </View>
        <View style={styles.containerContent}>
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
        </View>
      </View>
    </ScrollView>
  );
};

export default LearningFeatureModule;

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
    marginBottom: 10,
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
});
