import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { LoginRequest } from '../request/LoginRequest';
import { ResponseAuth } from '../response/ResponseAuth';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class LoginService {

  private baseUrl = environment.apiUrl;
  constructor(private _http: HttpClient) {
  }

  login = (credential: LoginRequest): Observable<ResponseAuth> => {
    let formData: FormData = new FormData();
    formData.append('email',credential.email);
    formData.append('password',credential.password);
    return this._http.post<ResponseAuth>(`${this.baseUrl}/login`, formData, {
      headers: {
        "Content-Type": "application/json"
      }
    }).pipe();
  }
}
