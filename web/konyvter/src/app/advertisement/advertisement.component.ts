import { Component, OnInit } from '@angular/core';
import { HttpClient} from '@angular/common/http';
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
  ad:any = [];
  userArray:any = [];
  bookArray:any = [];

  constructor(
    private http: HttpClient,
    private route: ActivatedRoute
  ) { }
  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    this.getAdData();
  }
  getAdData(){
    let endpoint = 'web/advertisements/';
    let url = this.host + endpoint + this.id;
    console.log(url);
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.ad = res.data;
        this.getBookData();
        this.getUserData();
      }, (error) => {
        console.error(error);
    });
  }
  getBookData(){
    let endpoint = 'web/books/';
    let url = this.host + endpoint + this.ad.book_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.bookArray = res.data;
      }, (error) => {
        console.error(error);
    });
  }
  getUserData(){
    let endpoint = 'account/';
    let url = this.host + endpoint + this.ad.user_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.userArray = res.data;
      }, (error) => {
        console.error(error);
    });
  }
}
