package main

import "fmt"

func main1() {
	q := resizingArrayQueueOfStrings{data: make([]string, 1), len: 0}
	for {
		s := ""
		fmt.Scanf("%s", &s)
		if s == "-" {
			q.out()
		} else {
			q.in(s)
		}
		fmt.Println(q)
	}
}

type resizingArrayQueueOfStrings struct {
	data []string
	len  int
}

func (q *resizingArrayQueueOfStrings) out() string {
	r := q.data[q.len-1]
	q.len--
	q.data[q.len] = ""
	if q.len <= (cap(q.data) / 4) {
		q.resize(q.len)
	}
	return r
}
func (q *resizingArrayQueueOfStrings) in(s string) {
	if q.len == cap(q.data) {
		q.resize(q.len)
	}
	q.data[q.len] = s
	q.len++
}
func (q *resizingArrayQueueOfStrings) resize(len int) {
	ns := make([]string, 2*len)
	copy(ns, q.data)
	q.data = ns
}

func (q resizingArrayQueueOfStrings) String() string {
	return fmt.Sprint(q.data, " len: ", q.len, " cap: ", cap(q.data))
}
