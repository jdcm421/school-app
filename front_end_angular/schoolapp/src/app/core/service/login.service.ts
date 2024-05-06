import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { ResponseAuth } from '../response/ResponseAuth';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class LoginService {

  private baseUrl = environment.apiUrl;
  constructor(private _http: HttpClient) {
  }

  login = (emails?:string , passwords?:string): Observable<ResponseAuth> => {
    console.log(emails);
    console.log(passwords);
    const form = new FormData();
    form.append("email",emails);
    form.append('password',passwords);
    return this._http.post<ResponseAuth>(`${this.baseUrl}/admin/login`, {
      form
    }, {
      headers: {
        "Content-Type": "application/json"
      }
    }).pipe();
  }
}
