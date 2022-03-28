import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-advertisement',
  templateUrl: './advertisement.component.html',
  styleUrls: ['./advertisement.component.css']
})
export class AdvertisementComponent implements OnInit {

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';
  id:any;
  ad!:any;
  book:any;

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService,
    private route: ActivatedRoute
  ) { }
  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    this.getAdData();
    // this.getBookData();
  }
  getAdData(){
    let endpoint = 'web/advertisements/';
    let url = this.host + endpoint + this.id;
    console.log(url);
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.ad = res.data;
        this.getBookData(res.data);
      }, (error) => {
        console.error(error);
    });
  }
  getBookData(data:any){
    console.log(this.ad);
    let endpoint = 'web/books/';
    let url = this.host + endpoint + data.book_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.book = res.data;
        console.log(this.book)
      }, (error) => {
        console.error(error);
    });
  }
}
