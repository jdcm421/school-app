import { Course } from "./ResponseCourse";
import { ResponseSchool } from "./ResponseSchool";
import { Student } from "./ResponseStudent";

export interface ResponseDashboard extends ResponseSchool {
  data?:Dashboard;
}

export interface Dashboard {
  topCourse?: Course[];
  topStudent?: Student[];
  student?: number;
  course?: number;
  oneCourse?: Course[];
}
