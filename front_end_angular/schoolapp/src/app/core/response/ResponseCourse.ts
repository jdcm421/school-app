export interface ResponseCourse {
  data?: Course[];
}

export interface Course {
  id?:                       number;
  name?:                     string;
  date_start?:               Date;
  date_end?:                 Date;
  schedule?:                 string;
  type?:                     string;
  student_and_course_count?: number;
  students_count?:           number;
}
