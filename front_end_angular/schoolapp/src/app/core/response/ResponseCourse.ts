export interface ResponseCourse {
  data?: Course[];
}

export interface Course {
  id?: number;
  name?: string;
  schedule?: string;
  date_star?: string;
  date_end?: string;
  type?: string;
  courses_count?: number;
}
