import { ResponseSchool } from './ResponseSchool';
export interface ResponseStudent extends ResponseSchool {
  data?:Student[];
}

export interface Student {
  id?:                  number;
  name?:                string;
  last_name?:           string;
  age?:                 number;
  identification_card?: string;
  email?:               string;
  courses_count?:       number;
}
