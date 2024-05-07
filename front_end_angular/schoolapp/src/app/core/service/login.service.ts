import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { ResponseAuth } from '../response/ResponseAuth';
import { Observable, tap } from 'rxjs';
import { LoginRequest } from '../request/LoginRequest';
import { ResponseSchool } from '../response/ResponseSchool';

@Injectable({
  providedIn: 'root',
})
export class LoginService {

  private baseUrl = environment.apiUrl;
  constructor(private _http: HttpClient) {
  }

  login = (credential : LoginRequest): Observable<ResponseAuth> => {
    return this._http.post<ResponseAuth>(`${this.baseUrl}/admin/login`, credential , {
      headers: {
        "Content-Type": "application/json"
      }
    }).pipe(tap(this.saveToken.bind(this)));
  }

  logout = (): Observable<ResponseSchool> => {
    return this._http
      .get<ResponseSchool>(`${this.baseUrl}/auth/cerrar-sesion`, {
        headers: {
          'Content-Type': 'application/json',
          Authorization: 'Bearer ' + this.getToken(),
        },
      })
      .pipe(tap(this.deleteToken.bind(this)));
  };

  saveToken = (value : ResponseAuth): void => {
    localStorage.setItem('token',value.data?.api_token || "");
    localStorage.setItem('rol',value.data?.roles?.type||"");
    localStorage.setItem('user',value.data?.name + ' '+value.data?.last_name);
  }

  deleteToken = (value: ResponseSchool): void => {
    if (value.message == 'OK') {
      localStorage.removeItem('rol');
      localStorage.removeItem('user');
      localStorage.removeItem('token');
    }
  };

  getToken() {
    if (localStorage.getItem('token') !== null) {
      return localStorage.getItem('token');
    } else {
      return null;
    }
  }

  isAutenticated = () : boolean => {
    if(localStorage.getItem('token') !== null){
      return true;
    }
    return false;
  }
}
