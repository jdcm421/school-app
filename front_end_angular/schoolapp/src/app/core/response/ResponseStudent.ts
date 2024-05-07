export interface ResponseStudent {
  data?:Student[];
}

export interface Student {
  id?:                  number;
  name?:                string;
  last_name?:           string;
  identification_card?: string;
  age?:                 number;
  email?:               string;
  student_and_course_count?: number;
  students_count?:           number;
}
