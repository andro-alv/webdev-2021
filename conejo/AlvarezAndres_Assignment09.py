"""
AlvarezAndres_assign09.py
Written by: Andres Alvarez
Worked with: Cindy Mata and Renaldo Hyacinthe
November 19 2019
Section: CSCI-UA.002-003
"""
#this is the answer key used to score the tests for pt 3 of the assignment
answerkey = "B,A,D,D,C,B,D,A,C,C,D,B,A,B,A,C,B,D,A,C,A,A,B,D,D"
# this variable is set to none cuz it has no value yet
# it will be used to open a file
file_start=None
# file_name is set to "" because the input will be added to this variable later
file_name=""
# a while loop is used to ensure the user enters a correct class
while file_start==None:
    # ask user to enter a class
    file_name=input("Enter a class to grade (i.e. class1 for class1.txt): ")
    # a try/except block is used to ensure the program does not crash
    try:
        # if the user enters a correct class
        # the file_start variable will be set to open the class fie
        file_start=open(file_name+".txt")
        # tell user the file was opened
        print("Successfully opened",file_name+".txt")
    # if the program cant open the file
    except:
        # then tell the user the file cannot be found 
        print("File cannot be found.")
        # set file_start to = none
        file_start=None

# this function will be used to see if the University ID is valid
def validity(N):
    #checks to see if N starts with N
    # .startswith was found online
    # checks if the total length of N is 9
    if N.startswith("N") and len(N)==9:
        # try/except block to see if each value after N is a digit 
        try:
            # whill check if the values after N is a digit
            num=int(N[1:])
            #if so then it will return True
            return True
        # except block will return False 
        except:
            return False
    # if the University ID doesnt meet the requirements in the if statement
    # program will return False
    return False
#print the analyzing component and format it to match the assignment 
print("\n**** ANALYZING ****\n")
# create a counter variable for the valid lines and invalid lines
lines_valid=0
lines_invalid=0
# create a list for the ID and the scores
list_scores=[] 
list_ID=[] 
#for loop is used to check the lines in the file
for line in file_start:
    #this will remove the line breaks
    # .strip() was a method found outside of class and the modules
    line=line.strip()
    #will split the lines on ","
    # line2 is the variable for the line split on ","
    line2=line.split(",")
    #if statement to check if the length of line2 is 26
    # if line2 is not 26 values
    if len(line2)!=26:
        #then the line is invalid
        # tell user it is invalid bc it is not 26 values
        # print the line that is invalid
        # and add to the invalidlines counter
        print("Invalid line of data: does not contain exactly 26 values:")
        print(line)
        print()
        lines_invalid += 1
    # if the line is 26 values
    else:
      #the line is valid
        # if the line2 runs the through the function and is not True 
        if not validity(line2[0]):
            #then the University ID is invalid
            # tell the user the N# is invalid
            # print the line that is invalid
            # add to the invalid lines counter
            print("Invalid line of data: N# is invalid")
            print(line)
            print()
            lines_invalid += 1
        # else
        else:
            # the line is valid
            # add to the valid lines counter
            lines_valid+=1
            # score is set to 0
            score=0
            #this is a temp list for the answer key
            # splits it on ","
            answerkey_list=answerkey.split(",")
            #for loop to calculate score
            for i in range(1,len(line2)):
                # if the value is equal to the correspoding value in the answerkey list
                # then it is a right answer
                if line2[i]==answerkey_list[i-1]:
                    #adds 4 to the score
                    score+=4
                # if the value doesnt match with the corresponding value in anskey
                elif not line2[i]=="":
                    # then -1 will be deducted from the score
                    score-=1
            #appends the score to the list scores
            list_scores.append(score)
            # adds the line2 to the ID lists
            list_ID.append(line2[0])
#close file
file_start.close()

# print report for user to match format in assignment
print('\n**** REPORT ****\n')
#finding the stats of pt 4
# sum of scores/ # of scores
mean = (sum(list_scores)/len(list_scores))
#max in hte scores lsit is the highest
highest_num = max(list_scores)
# min in the lowest_num 
lowest_num = min(list_scores)
numrange = highest_num-lowest_num
# will return mode
# used outside resources to learn about set and key
mode = max(set(list_scores), key=list_scores.count)
# set median to 0
median = 0

#creating a copy of scores to find median (scores need to be sorted)
# create a copy of the scores
# then sort
#.copy() was found from online resources
# copies the list
templist=list_scores.copy()
templist.sort()

#if statement to find median
# if the length of the scores list is even
if len(list_scores)%2==0:
    #take the average of the middle two values
    median=(templist[len(templist)//2]+templist[len(templist)//2 -1])/2
else:
    # if len of scores list is odd
    # the median is the middle value
    median=templist[len(temp_list)//2]

#print stats for user
print("Total valid lines of data: ",lines_valid)
print("Total invalid lines of data: ",lines_invalid)
print("\nMean (average) score:",format (mean, ".2f"))
print("Highest score:",highest_num)
print("Lowest score:",lowest_num)
print('Range of scores:',numrange) 
print("Median score:",median)
print("Mode score:",mode)


#ask user if they want to apply a curve to the score
yn_choice = input("\nWould you like to apply a curve to the scores? (y)es or (n)o? ");

#if user enters y
if yn_choice == 'y' or yn_choice == 'Y':

    #ask user for the desired mean
    newmean = int(input("\nEnter desired mean score: "))
    
    #curve is equal to difference between the new mean and actual mean 
    curve = (newmean - mean)

    #new file for the curves
    curve_file = file_name + "_grades_with_curve.txt";

    #open file to write it
    write_file = open(curve_file, "w")

    #goes through record of each student
    for a in range(len(list_ID)):
       #writes data in file
       data = (str(list_ID[a]) + ", " + str(list_scores[a]) + ", " + str((int(list_scores[a]) + curve)) + " \n")
       write_file.write(data)
    write_file.close()


    #Printing goodbye
    print("\nDone! A new grade file has been written ("+ curve_file +") \n\n\n")
# if choice is no tell user okay thanks
elif yn_choice == "N" or yn_choice == "n":
    print("Okay, thanks!")


#this is for pt5
pt5_file=file_name+'_grades.txt'
# open file
pt5_open=open(pt5_file,'w+')
# counter variable
i=0
#while loop for writing out the lines
while i<len(list_ID):
    # writes the ID and score and formats it to match assignment
    pt5_open.write('{:s},{:d}\n'.format(list_ID[i],list_scores[i]))
    # add 1 to counter
    i+=1
#file closes when i reaches length of ID list
pt5_open.close()
