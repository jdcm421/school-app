export interface ResponseAuth extends Response {
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
}
