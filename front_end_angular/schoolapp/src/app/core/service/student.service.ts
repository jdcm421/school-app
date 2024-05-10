import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { StudentRequest } from '../request/StudentRequest';
import { ResponseSchool } from '../response/ResponseSchool';
import { ResponseStudent, Student } from '../response/ResponseStudent';
import { LoginService } from './login.service';

@Injectable({
  providedIn: 'root',
})
export class StudentService {
  private baseUrl = environment.apiUrl;
  constructor(private _http: HttpClient,
    private auth : LoginService
  ){}

  getStudent() : Observable<ResponseStudent>{
    return this._http.get<ResponseStudent>(`${this.baseUrl}/admin/student/lista`,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }

  register(request: StudentRequest) : Observable<ResponseSchool> {
    return this._http.post<ResponseSchool>(`${this.baseUrl}/admin/student/register`,request,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }

  getStudentId(id:number) : Observable<Student> {
    return this._http.get<Student>(`${this.baseUrl}/admin/student/`+id,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }

  updated(id:number, request:StudentRequest) : Observable<ResponseSchool> {
    return this._http.post<ResponseSchool>(`${this.baseUrl}/admin/student/update/`+id,request,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }

  delete(id:number) : Observable<ResponseSchool> {
    return this._http.delete<ResponseSchool>(`${this.baseUrl}/admin/student/`+id,{
      headers:{
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + this.auth.getToken(),
      }
    }).pipe();
  }
}

