package main

import (
	"crypto/sha256"
	"encoding/hex"
	"encoding/json"
	"fmt"
	"io"
	"log"
	"net/http"
	"strconv"
	"strings"
)

const (
	port = 8090
)

type Request struct {
	StudentID int `json:"student_id"`
	CourseID  int `json:"course_id"`
}

type Response struct {
	CourseNumber string `json:"course_number"`
}

func createCertificateHandler(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		http.Error(w, "method not allowed", http.StatusMethodNotAllowed)
		return
	}

	// ClientId остаётся техническим заголовком
	if r.Header.Get("ClientId") == "" {
		http.Error(w, "ClientId header is required", http.StatusBadRequest)
		return
	}

	body, err := io.ReadAll(r.Body)
	if err != nil {
		http.Error(w, "cannot read body", http.StatusBadRequest)
		return
	}
	defer r.Body.Close()

	var req Request
	if err := json.Unmarshal(body, &req); err != nil {
		http.Error(w, "invalid json", http.StatusBadRequest)
		return
	}

	// Генерация 6 символов: student_id + course_id
	source := strconv.Itoa(req.StudentID) + ":" + strconv.Itoa(req.CourseID)

	hash := sha256.Sum256([]byte(source))
	hashHex := hex.EncodeToString(hash[:])

	courseNumber := strings.ToUpper(hashHex[:6])

	resp := Response{
		CourseNumber: courseNumber,
	}

	w.Header().Set("Content-Type", "application/json")
	json.NewEncoder(w).Encode(resp)
}

func main() {
	http.HandleFunc("/create-sertificate", createCertificateHandler)

	log.Printf("Certification mock server started on :%v", port)
	log.Fatal(http.ListenAndServe(fmt.Sprintf(":%v", port), nil))
}
