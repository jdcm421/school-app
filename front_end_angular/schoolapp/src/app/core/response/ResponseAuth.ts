import { ResponseSchool } from "./ResponseSchool";

export interface ResponseAuth extends ResponseSchool {
  data?:User;
}

export interface User {
  id?:number;
  name?:string;
  last_name?:string;
  age?:number;
  email?:string;
  password?:string;
  api_token?:string;
  roles_id?:  number;
  roles?:     Roles;
}

export interface Roles {
  id?:   number;
  type?: string;
}
