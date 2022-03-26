import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})

export class NewadvertisementService {

  host = 'http://localhost:8000/api/';
  constructor(private http: HttpClient,private router: Router) { }

  getGenres(){
    let endpoint = 'web/genres';
    let url = this.host + endpoint;
    return this.http.get<any>(url);
  }
}
