import { Component, OnInit } from '@angular/core';
import { StudentService } from 'src/app/core/service/student.service';
import { Student } from '../../core/response/ResponseStudent';

@Component({
  selector: 'app-student',
  templateUrl: './student.component.html',
  styleUrls: ['./student.component.scss']
})
export class StudentComponent implements OnInit {
  student : Student[];
  onlyStudent: Student;
  constructor(private stuentService : StudentService){

  }
  ngOnInit(): void {
    this.student = [];
    this.onlyStudent = {};
    this.getStudent();
  }

  getStudent(){
    this.stuentService.getStudent().subscribe(response => {
      console.log(response);
      this.student= response.data || [];
    }, (error: any) => {
      console.log(error);
    });
  }

}
